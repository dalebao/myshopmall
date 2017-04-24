<template>
    <div style="height: 300px;">
        <el-row :gutter="20">
            <el-col :span="12">
                <h3>点击分类进行搜索</h3>
            </el-col>
            <el-col :span="10">
                <el-cascader
                        placeholder="试试搜索：鞋子"
                        :options="options"
                        filterable
                        @change="handleChange"
                ></el-cascader>
            </el-col>
        </el-row>
    </div>
</template>


<script>
    export default {
        data()
        {
            return {
                item_id: 'false',
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
                this.$emit('sendCategory', {

                    category_fa: value['0'],
                    category_son: value['1']
                })
            }
        }
    }
</script>