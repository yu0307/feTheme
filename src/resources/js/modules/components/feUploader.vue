<template>
  <div class="fe_uploader_control" :id="id">
    <form enctype="multipart/form-data" novalidate ref="myForm">
      <label for="fileToUpload" v-if="label">{{ label }}</label>
      <div
        v-if="canDrop"
        ref="dropzone"
        id="drop"
        class="dropzone"
        @dragover.prevent="drageOver"
        @dragleave="drageLeave"
        @drop.prevent.stop="dropin"
      >
        <div class="drop-inner">
          <h3><span class="fw-bold">Drop Files</span> to Upload</h3>
          <span class="btn btn-primary LF_UploadBrowse" @click="showWindow"
            >Browse</span
          >
        </div>
      </div>
      <div v-else>
        <span class="btn btn-primary LF_UploadBrowse" @click="showWindow"
          >Browse</span
        >
      </div>
      <slot></slot>
      <input
        ref="fileToUpload"
        type="file"
        :name="fieldName"
        class="fe_uploaderCtrl"
        v-show="false"
        :multiple="settings.multiple"
        :accept="settings.accepts.join(',')"
        @change="CheckUpload($event.target)"
      />
    </form>
    <div v-show="showStatus && status" class="upload_info" id="upload_info">
      <div class="info-details">
        <div id="upload_info_loading" class="upload_info_loading">
          <i class="fa fa-spinner fa-spin fa-fw"></i>&nbsp;&nbsp;
          <span id="proc_cnt">{{ status }} ...</span>
        </div>
		<div class="progress">
			<div class="progress-bar progress-bar-striped bg-success" role="progressbar" :style="{ width: progress+'%'}" :ariaValuenow="progress" aria-valuemin="0" aria-valuemax="100">{{progress}}%</div>
		</div>
        <div id="upload_info_content" class="upload_info_content"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "uploader",
  props: {
    fieldName: {
      default: "fileToUpload",
    },
    multiple: {
      default: false,
    },
    accepts: {
      default: () => ["image/*"], //   audio/*, video/*
    },
    label: {
      default: null,
    },
    targetUrl: {
      default: "./",
    },
    postData: {
      default() {
        return [];
      },
    },
    CtrlStatus: {
      status: "",
      message: "",
    },
    showStatus: {
      default: false,
    },
    id: {
      default: null,
    },
    canDrop: {
      default: false,
    },
    uploadProgress: null,
  },
  model: {
    prop: "CtrlStatus",
    event: "StatusUpdate",
  },
  data() {
    return {
      settings: {
        ...this.$props,
      },
      status: null,
	  progress:0
    };
  },
  methods: {
    dropin(evnt) {
      this.$refs.fileToUpload.files = evnt.dataTransfer.files;
      this.CheckUpload(this.$refs.fileToUpload);
    },
    drageOver() {
      if (!this.$refs.dropzone.classList.contains("fileover"))
        this.$refs.dropzone.classList.add("fileover");
    },
    drageLeave() {
      this.$refs.dropzone.classList.remove("fileover");
    },
    showWindow() {
      this.$refs.fileToUpload.click();
    },
    UpdateStatus({ status = "ok", message = "" }) {
      this.$emit("StatusUpdate", { status, message });
    },
    CheckUpload(FileData) {
      try {
        this.status = "Preparing uploads";
        this.$emit("fileAttached", FileData.files);
        if (FileData.files.length <= 0) return;
        const formData = new FormData();
        Array.from(FileData.files).map(
          function (f) {
            formData.append(FileData.name + "[]", f, f.name);
          }.bind(formData)
        );
        const postData = this.postData;
        Object.keys(postData).forEach(
          function (item) {
            formData.append(item, postData[item] || "");
          }.bind(postData)
        );
        this.status = "Uploading";
        this.UpdateStatus({ message: this.status });
        const request = axios.post(this.settings.targetUrl, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
          onUploadProgress:
            typeof this.uploadProgress == "function"
              ? this.uploadProgress
              : function (progressEvent) {
					this.progress=(parseFloat((progressEvent.loaded/progressEvent.total))*100).toFixed(2);
                  this.$emit("progressUpdate", progressEvent);
                }.bind(this),
        });
        this.$emit("requestSent", request);
        request
          .then(
            function (response) {
              this.UpdateStatus(response.data);
            }.bind(this)
          )
          .catch(
            function (error) {
              this.UpdateStatus(error.toJSON());
            }.bind(this)
          )
          .then(function () {
            this.reset();
          }.bind(this));
        return request;
      } catch (error) {
		  this.reset();
	  }
    },
    reset() {
      this.$refs.myForm.reset();
      this.status = "";
	  this.progress=0;
    },
    setProp(key, val) {
      this.settings[key] = val;
    },
  },
};
</script>

<style lang="scss">
.fe_uploader_control {
  min-height: 20px;
  text-align: center;
  width: 100%;
  display: flex;
  align-items: center;
  margin: 10px 0px;
  position: relative;
  form {
    width: 100%;
    margin: auto;
    .dropzone {
      min-height: 100px;
      display: flex;
      &.fileover {
        border-style: dotted;
        border-width: 3px;
        border-color: #e2e2e2;
      }
      .drop-inner {
        margin: auto;
      }
    }
  }
  .upload_info {
    background: #000000e0;
    color: white;
    position: absolute;
    top: 0px;
    left: 0px;
    right: 0px;
    bottom: 0px;
    display: flex;
    .info-details {
      margin: auto;
		width: 50%;
      .upload_info_loading {
        font-size: 20px;
      }
	  .progress{
		  text-align: center;
		  margin: 5px 0px;
	  }
    }
  }
}
</style>