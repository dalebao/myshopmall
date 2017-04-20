<template>
    <Card style="width:350px" v-loading.body="loading">
        <p slot="title">
            <Icon type="ios-film-outline"></Icon>
            高分商品
        </p>
        <a href="#" slot="extra" @click.prevent="changeLimit">
            <Icon type="ios-loop-strong"></Icon>
            换一换
        </a>
        <ul>
            <li v-for="item in randomMovieList">
                <a :href="item.url" target="_blank">{{ item.name }}</a>
                <span>
                    <Icon type="ios-star" v-for="n in 4" :key="n"></Icon><Icon type="ios-star"
                                                                               v-if="item.rate >= 5"></Icon><Icon
                        type="ios-star-half" v-else></Icon>
                    {{ item.rate }}
                </span>
            </li>
        </ul>
    </Card>
</template>
<script>
    export default {
        data () {
            return {
                movieList: [],
                randomMovieList: [],
                loading:true,
            }
        },
        methods: {
            changeLimit () {
                this.randomMovieList = getArrayItems(this.movieList, 10);
                function getArrayItems(arr, num) {
                    const temp_array = [];
                    for (let index in arr) {
                        temp_array.push(arr[index]);
                    }
                    const return_array = [];
                    for (let i = 0; i < num; i++) {
                        if (temp_array.length > 0) {
                            const arrIndex = Math.floor(Math.random() * temp_array.length);
                            return_array[i] = temp_array[arrIndex];
                            temp_array.splice(arrIndex, 1);
                        } else {
                            break;
                        }
                    }
                    return return_array;
                }

            }
        },
        mounted () {
            this.changeLimit();
        },
        created(){
            axios.get('/api/front/high_score').then(res=>{
                this.movieList = res.data
                this.changeLimit()
                this.loading = false

            })
        }
    }
</script>
