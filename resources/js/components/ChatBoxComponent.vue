<template>
    <div id="frame">
        <messages-component
            v-bind:messages="messages"
            :alertid="alertid"
            :userid="userid"
        ></messages-component>

        <infinite-loading direction="top" @infinite="chats"></infinite-loading>
    </div>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";
export default {
    props: ["alertid", "userid"],
    name: "ChatBoxComponent",
    components: {
        InfiniteLoading,
    },
    data() {
        return {
            page: 1,
            messages: [],
        };
    },
    methods: {
        chats($state) {
            axios
                .get(`/api/chat/${this.alertid}`, {
                    params: {
                        page: this.page,
                    },
                    mode: "no-cors",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json",
                    },
                    withCredentials: true,
                    credentials: "same-origin",
                })
                .then(({ data }) => {
                    if (data.data.data.length) {
                        this.page += 1;
                        this.messages.unshift(...data.data.data.reverse());
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                });
        },
    },
    created() {
        Echo.channel(`groupChat.${this.alertid}`).listen("GroupChat", (e) => {
            this.messages.push(e.message);
        });
    },
};
</script>

<style scoped></style>
