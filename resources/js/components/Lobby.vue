<script>
import { get, post } from '../api/api.js';
import { ref, onMounted, computed } from 'vue';
import { useRoute } from 'vue-router';

import CustomButton from './CustomButton';

export default {
    props: {
        gamePlayers: [],
    },
    components: {
        CustomButton,
    },
    setup() {

        const CreatorIP = ref();
        const route = useRoute();
        const gameId = ref(route.params.id);
        const playerIP = ref(localStorage.getItem('playerIP') || '127.0.0.1');
        
        const getCreator = async () => {
            try {
                const response = await get(`creator/${gameId.value}`);
                CreatorIP.value = response.ip_address;

            } catch (error) {
                console.error(error);
            }
        };

        const isCreator = computed(() => {
            return CreatorIP.value == playerIP.value;
        });

        const startGame = () => {
            console.error('working');
        };

        onMounted(() => {
            getCreator();
        });

        return {
            isCreator,
            startGame
        }
    }
}
</script>

<template>
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-10">
            <div class="section__title text-center mb-60">
                <span class="sub-title tg__animate-text">Lobby</span>
                <h3 class="title">The hero's that will play</h3>
            </div>
        </div>
    </div>
    <div class="swiper-container streamers-active">
        <div class="swiper-wrapper">
            <div class="swiper-slide" v-for="(player, index) in gamePlayers" :key="player.id">
                <div class="streamers__item">
                    <div class="streamers__thumb">
                        <a href="team-details.html"><img :src="`images/team/streamers0${index + 1}.png`" alt="img"></a>
                    </div>
                    <div class="streamers__content">
                        <h4 class="name">{{ player.name }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="streamers__pagination">
            <div class="slider-button-prev streamers__pagination-arrow"><i class="fas fa-angle-left"></i></div>
            <div class="swiper-pagination streamers__pagination-dots"></div>
            <div class="slider-button-next streamers__pagination-arrow"><i class="fas fa-angle-right"></i></div>
        </div>
        <CustomButton v-if="isCreator" :text="'Play'" :emitName="'start-game'" @start-game="startGame" />
    </div>
</template>