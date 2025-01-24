<template>
  <div class="content">
    <div class="contact-profile">
      <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt />
      <p>Harvey Specter</p>
      <div class="social-media">
        <i class="fa fa-facebook" aria-hidden="true"></i>
        <i class="fa fa-twitter" aria-hidden="true"></i>
        <i class="fa fa-instagram" aria-hidden="true"></i>
      </div>
    </div>
    <!--        {{messages}}-->
    <div class="messages">
      <ul>
        <li
          v-bind:class="{ replies: message.user_id == 1,  sent: message.user_id != 1 }"
          v-for="(message, $index) in messages"
          :key="$index"
        >
          <img src="http://emilcarlsson.se/assets/mikeross.png" alt />
          <p>{{message.message}}</p>
        </li>
      </ul>
    </div>
    <div class="message-input">
      <div class="wrap">
        <input type="text" v-model="message" placeholder="Write your message..." />
        <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
        <button @click="sendMessage" class="submit">
          <i class="fa fa-paper-plane" aria-hidden="true"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MessagesComponent",
  props: ["messages", "alertid", "userid"],
  data() {
    return {
      message: ""
    };
  },
  methods: {
    sendMessage() {
      axios
        .post(`/message/${this.alertid}`, {
          message: this.message,
          user_id: this.userid,
          alert_id: this.alertid
        })
        .then(function(response) {
          this.message = "";
          //  $(".messages").animate({ scrollTop: $(document).height() }, "fast");
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
</style>
