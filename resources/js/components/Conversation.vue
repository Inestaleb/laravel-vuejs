<template>
  <div class="chat-cont-right">
    <div class="chat-header">
      <div class="media">
        <div class="media-img-wrap">
          <div class="avatar avatar">
            <img
              v-if="user.role_id == 3"
              :src="'/images/doctor/' + selectedContact.image"
              alt="User Image"
              class="avatar-img rounded-circle"
            />
            <img
              v-if="user.role_id == 1"
              :src="'/images/Patients/' + selectedContact.image"
              alt="User Image"
              class="avatar-img rounded-circle"
            />
          </div>
        </div>
        <div class="media-body">
          <div class="user-name">
            {{
              selectedContact
                ? selectedContact.name
                : "Selectionner un  Contact"
            }}
          </div>
        </div>
      </div>
    </div>

    <MessagesFeed :contact="selectedContact" :messages="messages" />
    <MessageComposer v-on:send="sendMessage" />
  </div>
</template>

<script>
import MessagesFeed from "./MessagesFeed";
import MessageComposer from "./MessageComposer";
export default {
  data: function () {
    return {
      user: this.auth.user,
    };
  },

  props: {
    selectedContact: {
      type: Object,
      default: null,
    },

    messages: {
      type: Array,
      required: true,
    },
  },

  methods: {
    sendMessage(text) {
      if (!this.selectedContact) {
        return;
      }
      axios
        .post("/api/conversation/send", {
          sender_id: this.user.id,
          receiver_id: this.selectedContact.id,
          text: text,
        })
        .then((response) => {
          // console.log(response.data);
          this.$emit("send", response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  components: { MessagesFeed, MessageComposer },
};
</script>

<style lang="scss" scoped>
.conversation {
  flex: 5;
  display: flex;
  flex-direction: column;
  justify-content: space-between;

  h1 {
    font-size: 20px;
    padding: 10px;
    margin: 0;
    border-bottom: 1px dashed lightgray;
  }
}
</style>
