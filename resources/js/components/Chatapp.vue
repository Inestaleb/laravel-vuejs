
<template>
  <div>
    <div v-if="this.auth.user">
      <div v-if="this.auth.user.role_id == 3"><Header></Header></div>
      <div v-else-if="this.auth.user.role_id == 1"><Header1></Header1></div>
    </div>
    <div class="chat-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12">
              <div class="chat-window">
                <contact-list
                  v-if="user.role_id == 3"
                  :contacts="contacts"
                  v-on:selected="startConversationWith"
                />
                <List
                  v-if="user.role_id == 1"
                  :contacts="contacts"
                  v-on:selected="startConversationWith"
                />

                <conversation
                  :user="user"
                  :messages="messages"
                  :selectedContact="selectedContact"
                  v-on:send="saveNewMessage"
                />

                <!-- :contact="selectedContact" -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <pre></pre>
    <pre></pre>
    <pre></pre>
    <div class="footer">
      <Footer></Footer>
    </div>
  </div>
</template>

<script>
import Conversation from "./Conversation";
import ContactList from "./ContactList";
import List from "./List.vue";
import Header from "../pages/Patient/Header.vue";
import Header1 from "../pages/Doctor/Header.vue";
import Footer from "../pages/Footer.vue";
export default {
  components: {
    ContactList,
    Conversation,
    List,
    Header,
    Header1,
    Footer,
  },

  data: function () {
    return {
      messages: [],
      contacts: [],
      selectedContact: null,
      user: this.auth.user,
    };
  },

  mounted() {
    Echo.private(`messages.${this.user.id}`).listen("NewMessage", (e) => {
      this.handleIncoming(e.message);
    });

    axios
      .get("http://localhost:8000/api/contact-list/" + this.user.id)
      .then((response) => {
        this.contacts = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  methods: {
    startConversationWith(contact) {
      this.updateUnreadCount(contact, true);
      axios
        .get("http://localhost:8000/api/conversation/" + contact.id)
        .then((response) => {
          this.messages = response.data;
          console.log(response.data);
          this.selectedContact = contact;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    saveNewMessage(msg) {
      this.messages.push(msg);
    },
    handleIncoming(message) {
      if (this.selectedContact && message.from == this.selectedContact.id) {
        this.saveNewMessage(message);
        return;
      }
      this.updateUnreadCount(message.from_contact, false);
    },
    updateUnreadCount(contact, reset) {
      this.contacts ==
        this.contacts.map((single) => {
          if (single.id != contact.id) {
            return single;
          }
          if (reset) {
            single.unread = 0;
          } else {
            single.unread += 1;
          }
          return single;
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.chat-app {
  display: flex;
}
</style>
