<template>
    <div     v-loading.fullscreen.lock="loading">
        <div class="main-page-line">
            <carousel></carousel>
        </div>
        <div class="main-page-pic">
            <a href="">
                <img src="https://img.alicdn.com/tps/TB1lnWUNVXXXXbxXpXXXXXXXXXX-880-70.jpg_q90_.webp" alt="">
            </a>
        </div>
        <div class="main-page-line">
            <card :items="item_one"></card>
        </div>
        <div class="main-page-pic">
            <a href="">
                <img src="https://img.alicdn.com/tps/TB1lnWUNVXXXXbxXpXXXXXXXXXX-880-70.jpg_q90_.webp" alt="">
            </a>
        </div>
        <div class="main-page-line">
            <card :items="item_one"></card>
        </div>
        <div class="main-page-pic">
            <a href="">
                <img src="https://img.alicdn.com/tps/TB1lnWUNVXXXXbxXpXXXXXXXXXX-880-70.jpg_q90_.webp" alt="">
            </a>
        </div>
    </div>

</template>
<script>
    import Carousel from './carousel.vue'
    import Card from './card.vue'
    export default {
        data(){
            return {
                item_one: '',
                loading:true
            }
        },
        components: {
            Carousel,
            Card
        },
        created(){
            axios.get('/api/front/item', {
                params: {}
            }).then(res => {
                this.item_one = res.data
                this.loading = false
            });

        }
    }
</script>

<style>
    .main-page-line {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .main-page-pic {
        text-align: center;
        margin: 50px auto;
    }
</style>

