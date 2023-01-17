<template>
  <div class="chat-body">
    <div class="chat-scroll">
      <div class="feed" ref="feed">
        <ul class="ul-element" v-if="contact">
          <li
            v-for="(message, index) in messages"
            :key="index.id"
            :class="`message${
              message.to == contact.id ? ' received  ' : ' sent'
            }`"
          >
            <div class="avatar" v-if="message.from == contact.id">
              <img
                v-if="user.role_id == 1"
                :src="'/images/Patients/' + contact.image"
                alt="User Image"
                class="avatar-img rounded-circle"
              />
              <img
                v-if="user.role_id == 3"
                :src="'/images/doctor/' + contact.image"
                alt="User Image"
                class="avatar-img rounded-circle"
              />
            </div>
            <div class="text">
              {{ message.text }}
            </div>
          </li>
        </ul>

        <ul v-else class="withOutLoadingConversation">
          <p style="font-size: 18px">Séléctionner un contact.</p>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      user: this.auth.user,
    };
  },
  props: {
    contact: {
      type: Object,
    },
    messages: {
      // type:Object,
      // required:true
    },
  },
  methods: {
    scrollToBottom() {
      setTimeout(() => {
        this.$refs.feed.scrollTop =
          this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
      }, 50);
    },
  },
  watch: {
    contact(contact) {
      this.scrollToBottom();
    },
    messages(messages) {
      this.scrollToBottom();
    },
  },
};
</script>

<style lang="scss" scoped>
.ul-element {
  margin-top: -124px;
}
.feed {
  background: #f0f0f0;
  padding-top: 120px;
  height: 100%;
  max-height: 370px;
  overflow-y: auto;

  ul {
    list-style-type: none;
    padding: 5px;

    li {
      &.message {
        margin: 10px 0;
        width: 100%;

        .text {
          max-width: 200px;
          border-radius: 5px;
          padding: 12px;
          display: inline-block;
        }

        &.received {
          text-align: right;
          .text {
            background: #7bd7f0;
          }
        }
        &.sent {
          // padding-top: -50px;
          text-align: left;

          .text {
            background: #b3bbba;
          }
        }
      }
    }
  }
}
.withOutLoadingConversation {
  height: 90%;
  margin-top: 190px;
  p {
    margin-top: -160px;
    text-align: center;
  }
}
</style>
