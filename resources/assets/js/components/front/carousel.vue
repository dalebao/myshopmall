<template>
    <el-carousel :interval="5000" arrow="hover" height="500px">
        <el-carousel-item v-for="item in picurl" v-loading.fullscreen.lock="fullscreenLoading">
            <img class="img_class" :src="item.url" alt="item.name">
        </el-carousel-item>
    </el-carousel>
</template>


<script>
    export default{
        data(){
            return {
                picurl: [],
                fullscreenLoading: true
            }
        },
        methods: {
            openFullScreen() {
                this.fullscreenLoading = true;
                setTimeout(() => {
                    this.fullscreenLoading = false;
                }, 1000);
            }
        },
        created(){
            this.openFullScreen();
            axios.get('api/carousel').then(res => {
                this.picurl = res.data
            })
        }

    }

</script>
<style>
    .el-carousel__item h3 {
        color: #475669;
        font-size: 18px;
        opacity: 0.75;
        line-height: 300px;
        margin: 0;
    }

    .el-carousel__item:nth-child(2n) {
        background-color: #99a9bf;
    }

    .el-carousel__item:nth-child(2n+1) {
        background-color: #d3dce6;
    }

    .img_class {
        height: 100%;
        width: 100%;
    }
</style>