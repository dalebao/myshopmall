<template>
    <div class="index">
        <menu-nav></menu-nav>
        <el-row>
            <p class="line"></p>
        </el-row>
        <router-view></router-view>
        <el-row>
            <p class="line"></p>
        </el-row>
        <index-footer></index-footer>
    </div>


</template>


<script>
    import MenuNav from './menu.vue'
    import Carousel from './carousel.vue'
    import IndexFooter from './index-footer.vue'
export default {
    components:{
        MenuNav,
        Carousel,
        IndexFooter
    }
}
</script>

<style>
    .line{
        line-height:50px;
    }
</style>