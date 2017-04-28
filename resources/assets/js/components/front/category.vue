<template>
    <div class="main-page-category">

        <el-row>
            <el-col :span="8">
                <div>
                    <category-bar v-on:sendCategory="handleCategory"></category-bar>
                </div>
                <div class="feedback-bar">
                    <high-score></high-score>
                </div>
            </el-col>
            <el-col :span="16">
                <card :items="items.data"></card>
                <div class="block">
                    <el-pagination
                            @size-change="handleSizeChange"
                            @current-change="handleCurrentChange"
                            :current-page="items.current_page"
                            :page-size="page_size"
                            layout="total, prev, pager, next, jumper"
                            :total="items.total">
                    </el-pagination>
                </div>
            </el-col>
        </el-row>
    </div>

</template>


<script>
    import Card from './card.vue'
    import CategoryBar from './category-bar.vue'
    import FeedBackBar from './feedback-bar.vue'
    import Paginate from '../utils/paginate.vue'
    import HighScore from './highScore.vue'
    export default {
        data(){
            return {
                items: '',
                category: '',
                page: 1,
                page_size: 20
            }
        },
        components: {
            Card,
            CategoryBar,
            Paginate,
            HighScore
        },
        methods: {
            handleCategory(data){
                console.log(data)
                axios.get('/api/front/item', {
                    params: {
                        cate: 1,
                        page_size: this.page_size,
                        category: data
                    }
                }).then(res => {
                    this.items = res.data
                })
            },
            handleSizeChange(val) {
                console.log(`每页 ${val} 条`);
            },
            handleCurrentChange(val) {
                console.log(123)
                axios.get('/api/front/item', {
                    params: {
                        page: val,
                        cate: 1,
                        category: this.category,
                        page_size: this.page_size
                    }
                }).then(res => {
                    this.items = res.data
                })
            }
        },
        created(){
            axios.get('/api/front/item', {
                params: {
                    cate: 1,
                    page_size: this.page_size
                }
            }).then(res => {
                this.items = res.data
            })
        }
    }
</script>

<style>
    .block {
        text-align: right;
        margin: 20px;
    }
</style>