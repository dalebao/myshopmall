<template>
    <el-select v-model="value" placeholder="请选择">
        <el-option
                v-for="item in options"
                :label="item.label"
                :value="item.value"
                v-on:change="sendValue">
        </el-option>
    </el-select>
</template>

<script>
    export default {
        data() {
            return {
                options: [{
                    value: 'HTKY',
                    label: '百世快递'
                }, {
                    value: 'SF',
                    label: '顺丰快递'
                }, {
                    value: 'STO',
                    label: '申通快递'
                }, {
                    value: 'YTO',
                    label: '圆通速递'
                }],
                value: ''
            }
        }
    }
</script>