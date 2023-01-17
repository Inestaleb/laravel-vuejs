<template>
  <div class="chat-cont-left">
    <div class="chat-header">
      <span>Chats</span>
    </div>
    <div class="chat-users-list">
      <div class="chat-scroll">
        <div
          v-for="contact in sortedContacts"
          :key="contact.id"
          @click="selectContact(contact)"
          :class="{ selected: contact == selected }"
        >
          <a
            href="javascript:void(0);"
            class="media"
            v-if="contact.role_id == 3"
          >
            <div class="media-img-wrap">
              <div class="avatar avatar">
                <img
                  :src="'/images/Patients/' + contact.image"
                  alt="User Image"
                  class="avatar-img rounded-circle"
                />
              </div>
            </div>
            <div class="media-body">
              <div>
                <div class="user-name">{{ contact.name }}</div>
                <div class="user-last-chat">{{ contact.email }}</div>
              </div>
            </div>
            <span class="badge badge-success badge-pill" v-if="contact.unread">
              {{ contact.unread }}
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      selected: this.contacts.length ? this.contacts[0] : null,
    };
  },
  props: {
    contacts: {
      type: Array,
      default: [],
    },
  },
  methods: {
    selectContact(contact) {
      this.selected = contact;
      this.$emit("selected", contact);
    },
  },
  computed: {
    sortedContacts() {
      return _.sortBy(this.contacts, [
        (contact) => {
          if (contact == this.selected) {
            return Infinity;
          }
          return contact.unread;
        },
      ]).reverse();
    },
  },
};
</script>

<style lang="scss" scoped>
.contact-list {
  flex: 1;
  margin-left: -16px;
  max-height: 400px;
  overflow-y: scroll;
  background-color: white;
  border-left: 1px solid #a6a6a6;
  ul {
    list-style-type: none;
    padding-left: 0;
    li {
      display: flex;
      padding: 2px;
      border-bottom: 1px groove #e6e3e3;
      height: 80px;
      position: relative;
      cursor: pointer;

      &.selected {
        background: #dfdfdf;
      }
      span.unread {
        background: #e80303;
        color: white;
        position: absolute;
        right: 11px;
        top: 20px;
        display: flex;
        font-weight: 700;
        min-width: 20px;
        justify-content: center;
        align-items: center;
        line-height: 20px;
        font-size: 12px;
        padding: 0 4px;
        border-radius: 50%;
      }

      .avatar {
        flex: 1;
        display: flex;
        align-items: center;

        img {
          width: 35px;
          border-radius: 50%;
          margin: 0 auto;
        }
      }

      .contact {
        flex: 3;
        font-size: 10px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;

        p {
          margin: 0;

          &.name {
            font-weight: bold;
          }
        }
      }
    }
  }
}
</style>
