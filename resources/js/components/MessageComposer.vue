<template>
  <div class="chat-footer">
    <div class="input-group">
      <div class="input-group-prepend"></div>
      <input
        type="text"
        class="input-msg-send form-control"
        v-model="message"
        @keydown.enter="send"
        placeholder="Message..."
      />
      <div class="input-group-append">
        <button type="button" class="btn msg-send-btn" @click="send">
          <i class="fab fa-telegram-plane"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      message: "",
      image: "",
    };
  },
  methods: {
    saveImage(e) {
      this.message = this.image = e.target.files[0].name;
    },
    send(e) {
      e.preventDefault();
      if (this.message == "") {
        return;
      }
      this.$emit("send", this.message, this.image);
      this.message = "";
      this.image = "";
    },
  },
};
</script>

<style lang="scss" scoped>
.composer textarea {
  width: 100%;
  margin-top: 8px;
  resize: none;
  border-radius: 3px;
  border: 1px solid lightgray;
  padding: 6px;
}
</style>
