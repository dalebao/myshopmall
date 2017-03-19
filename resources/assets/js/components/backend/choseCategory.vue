<template>
    <div class="">
        <span class="demonstration">可选择任意一级菜单的选项</span>
        <el-cascader
                placeholder="试试搜索：指南"
                :options="options"
                filterable
                change-on-select
        ></el-cascader>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                options: [{
                    value: 'zhinan',
                    label: '指南',
                    children: [{
                        value: 'shejiyuanze',
                        label: '设计原则'
                    }, {
                        value: 'daohang',
                        label: '导航'
                    }, {
                        value: 'zujian',
                        label: '组件'
                    }]
                }, {
                    value: 'ssss',
                    label: 'sssss',
                    children: [{
                            value: 'form',
                            label: 'Form'
                        }, {
                            value: 'data',
                            label: 'Data'
                        }, {
                            value: 'notice',
                            label: 'Notice'
                        }, {
                            value: 'navigation',
                            label: 'Navigation'
                        }, {
                            value: 'others',
                            label: 'Others'
                        }, {
                            value: 'ziyuan',
                            label: '资源'
                        }]
                }]
            }
        }
    }
</script>