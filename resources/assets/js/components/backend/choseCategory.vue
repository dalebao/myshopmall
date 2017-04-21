<template>
    <el-cascader
            placeholder="试试搜索：鞋子"
            :options="options"
            filterable
            v-model="category"
            @change="handleChange"
    ></el-cascader>
</template>


<script>
    export default {
        data()
        {
            return {
                item_id: 'false',
                category: ['mobile', 'iphone'],
                options: [{
                    value: 'mobile',
                    label: '手机',
                    children: [{
                        value: 'xiaomi',
                        label: '小米'
                    }, {
                        value: 'iphone',
                        label: 'iPhone'
                    }, {
                        value: 'huawei',
                        label: '华为'
                    }]
                }, {
                    value: 'cloth',
                    label: '服装',
                    children: [{
                        value: 'man',
                        label: '男装'
                    }, {
                        value: 'male',
                        label: '女装'
                    }, {
                        value: 'child',
                        label: '童装'
                    }]
                }, {
                    value: 'shoes',
                    label: '鞋子',
                    children: [{
                        value: 'man',
                        label: '男鞋'
                    }, {
                        value: 'male',
                        label: '女鞋'
                    }, {
                        value: 'child',
                        label: '儿童鞋'
                    }]
                }],
            }
        }
        ,
        methods: {
            handleChange(value)
            {
                console.log(value)
                this.$emit('sendCategory', {
                    category_fa: value['0'],
                    category_son: value['1']
                })
            }
        }
        ,
        created()
        {
            if (this.$route.params.itemId != undefined) {
                axios.get('/api/item/' + this.$route.params.itemId).then(res => {
                    this.category = res.data.category
                })
            }
        }
    }
</script>