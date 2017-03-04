<template>
    <div class="index">
        <menu-nav></menu-nav>
        <carousel></carousel>
    </div>


</template>


<script>
    import MenuNav from './menu.vue'
    import Carousel from './carousel.vue'
export default {
    components:{
        MenuNav,
        Carousel
    }
}
</script>