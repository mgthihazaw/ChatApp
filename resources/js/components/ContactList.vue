<template>
  <div class="contacts-list">
    <ul v-if="activeUser.length>0">
      <li
        v-for="(contact,index) in contacts"
        :key="contact.id"
        @click="selectContact(index, contact)"
        :class="{ 'selected' :index == selected}"
      >
        <div class="avatar">
          <img :src="contact.profile_image" :alt="contact.name" />
        </div>
        <div class="contact">
          <p class="name">
            {{ contact.name }} &nbsp; &nbsp; &nbsp;
            <a class="badge badge-success" v-if="activeNow(contact)">active</a>
          </p>

          <p class="email">{{ contact.email }}</p>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    contacts: {},
    activeUser: {}
  },
  data() {
    return {
      selected: 0
    };
  },
  methods: {
    selectContact(index, contact) {
      this.selected = index;
      this.$emit("selected", contact);
    },
    activeNow(contact) {
      if(contact){
          let data = this.activeUser.some(function(el) {
        return el.id === contact.id;
      });
      return data;
      }
     
      
    },
    // joining(user){
    //   if (!this.activeUser.includes(user)) {
    //       this.contacts.push(user);
    //     }
    // },
  },
  created(){
    // this.$on('joining',(user)=>{
    //   if (!this.activeUser.includes(user)) {
    //       this.activeUser.push(user);
    //     }
    // })
    // this.$on('leaving',(user)=>{
    //   this.activeUser.some(function(el,index) {
    //        el.id === user.id ? this.activeUser.slice(index,1) : ''
    //     });
    // })
  }
};
</script>

<style lang="scss" scoped>
.contacts-list {
  flex: 2;
  max-height: 600px;
  overflow: scroll;
  border-left: 1px solid #a6a6a6;

  ul {
    list-style-type: none;
    padding-left: 0px;
    li {
      display: flex;
      padding: 2px;
      height: 80px;
      position: relative;
      cursor: pointer;

      &.selected {
        background: #9885b6;
      }

      .avatar {
        flex: 1;
        display: flex;
        align-items: center;

        img {
          width: 35px;
          border-radius: 50px;
          margin: 0 auto;
        }
      }
      .contact {
        flex: 3;
        font-size: 13px;
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
