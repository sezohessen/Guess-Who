<script>
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import { post } from '../api/api.js';

import CustomButton from '@/components/CustomButton';

export default {

    components: {
        CustomButton,
    },
    setup(props, { emit }) {
        const route = useRoute();
        const gameId = ref(route.params.id);

        const playerName = ref('');
        const playerIP = ref(localStorage.getItem('playerIP') || '127.0.0.1');

        const isJoinRequestSend = ref(false);

        const joinGame = async () => {
            try {
                if (isJoinRequestSend.value == true) { // Prevent multiple database calls  
                    return;
                }
                isJoinRequestSend.value = true;
                const response = await post(`join-game/${gameId.value}`, {
                    name: playerName.value,
                    ip_address: playerIP.value
                });
                isJoinRequestSend.value = false;
                emit('close-join');
            } catch (error) {
                console.error(error);
                isJoinRequestSend.value = false;
            }
        };

        return {
            playerName,
            joinGame,
        };
    },
};
</script>

<template>
    <section class="tournament__details-area">
        <div class="row justify-content-center">
            <div class="blog-post-wrapper">
                <div class="tournament__details-content">
                    <h1 style="text-align: center;" class="title">Join Game</h1>
                    <div class="tournament__details-form">
                        <section class="team__area team-bg text" data-background="assets/img/bg/team_bg.jpg"
                            style="text-align: center;">
                            <input v-model="playerName" type="text" placeholder="Type your name">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xl-6 col-lg-7 col-md-10">
                                        <div class="section__title text-center">
                                            <span class="sub-title tg__animate-text">Type your name</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <CustomButton :text="'Join YSTA'" :emitName="'join-game'" @join-game="joinGame" />
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>