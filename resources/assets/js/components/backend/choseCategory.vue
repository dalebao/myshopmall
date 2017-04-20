<template>
    <el-cascader
            placeholder="试试搜索：鞋子"
            :options="options"
            filterable
            @change="handleChange"
    ></el-cascader>
</template>


<script>
    export default {
        data() {
            return {
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
                },{
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
                }]
            }
        },
        methods: {
            handleChange(value){
                this.$emit('sendCategory',{
                    category_fa:value['0'],
                    category_son:value['1']
                })
            }
        }
    }
</script>