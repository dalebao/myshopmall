<template>
    <div>
        <div class="main-page-line">
            <carousel></carousel>
        </div>
        <div class="main-page-pic">
            <a href="">
                <img src="https://img.alicdn.com/tps/TB1lnWUNVXXXXbxXpXXXXXXXXXX-880-70.jpg_q90_.webp" alt="">
            </a>
        </div>
        <div class="main-page-line">
            <card :items="item_one" :title="title_one"></card>
        </div>
        <div class="main-page-pic">
            <a href="">
                <img src="https://img.alicdn.com/tps/TB1lnWUNVXXXXbxXpXXXXXXXXXX-880-70.jpg_q90_.webp" alt="">
            </a>
        </div>
        <div class="main-page-line">
            <card :items="item_two" :title="title_two"></card>
        </div>
        <div class="main-page-pic">
            <a href="">
                <img src="https://img.alicdn.com/tps/TB1lnWUNVXXXXbxXpXXXXXXXXXX-880-70.jpg_q90_.webp" alt="">
            </a>
        </div>
        <div class="main-page-line">
            <card :items="item_three" :title="title_three"></card>
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
                title_one: '手机',
                item_two: '',
                title_two: '服装',
                item_three: '',
                title_three: '鞋子',
            }
        },
        components: {
            Carousel,
            Card
        },
        created(){
            axios.get('/api/front/item', {
                params: {category_fa:'mobile'}
            }).then(res => {
                this.item_one = res.data
            });
            axios.get('/api/front/item', {
                params: {category_fa:'cloth'}
            }).then(res => {
                this.item_two = res.data
            });
            axios.get('/api/front/item', {
                params: {category_fa:'shoes'}
            }).then(res => {
                this.item_three = res.data
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

