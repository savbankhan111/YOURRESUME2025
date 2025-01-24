<template>
    <div id="contacts">
        <ul>
            <li class="contact">
                <div class="wrap">
                    <span class="contact-status online"></span>
                    <img src="http://emilcarlsson.se/assets/louislitt.png" alt="" />
                    <div class="meta">
                        <p class="name">Louis Litt</p>
                        <p class="preview">You just got LITT up, Mike.</p>
                    </div>
                </div>
            </li>
            <li class="contact active"  v-for="(contact, $index) in contacts" :key="$index">
                <div class="wrap">
                    <span class="contact-status busy"></span>
                    <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                    <div class="meta">
                        <p class="name">{{contact.group_name}}</p>
                        <p class="preview">{{contact.message}}</p>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</template>

<script>
    export default {
        name: "ContactsComponent",
        props:["contacts"]
    }
</script>

<style scoped>

</style>
