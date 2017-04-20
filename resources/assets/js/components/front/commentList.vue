<template>
    <el-card class="box-card">
        <el-form label-width="80px">
            <div v-for="item in msg" class="text item">
                <el-col :span="10" v-if="!item.is_anonymous">
                    <el-form-item label="昵称">
                        {{item.username}}
                    </el-form-item>
                </el-col>
                <el-col :span="10">
                    <el-form-item label="昵称" v-if="item.is_anonymous">
                        {{item.nickname}}
                    </el-form-item>
                </el-col>
                <el-col :span="14">
                    <el-form-item label="评分">
                        <el-rate
                                show-text
                                disabled
                                v-model="item.score"
                                :colors="['#99A9BF', '#F7BA2A', '#FF9900']">
                        </el-rate>
                    </el-form-item>
                </el-col>
                <el-form-item label="评论">
                    {{item.comment}}
                </el-form-item>
            </div>
        </el-form>
    </el-card>
</template>

<script>
    export default{
        props: ['msg'],
        data(){
            return {}
        }
    }
</script>
<style>
    .text {
        font-size: 14px;
    }

    .item {
        padding: 18px 0;
    }

    .box-card {
        width: 480px;
    }
</style>