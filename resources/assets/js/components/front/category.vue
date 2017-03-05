<template>
    <div class="main-page-category">

        <el-row>
            <el-col :span="8">
                <div>
                    <category-bar></category-bar>
                </div>
                <div class="feedback-bar">
                    <FeedBackBar></FeedBackBar>
                </div>
            </el-col>
            <el-col :span="16">
                <card></card>
                <paginate></paginate>
            </el-col>
        </el-row>

    </div>

</template>


<script>
    import Card from './card.vue'
    import CategoryBar from './category-bar.vue'
    import FeedBackBar from './feedback-bar.vue'
    import Paginate from '../utils/paginate.vue'
    export default {
        components: {
            Card,
            CategoryBar,
            FeedBackBar,
            Paginate
        }
    }
</script>

<style>

</style>