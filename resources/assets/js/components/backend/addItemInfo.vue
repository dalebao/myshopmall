<template>
    <el-form :model="addItemForm" :rules="rules" ref="addItemForm" label-width="100px" class="demo-addItemForm">
        <el-form-item label="商品名称" prop="name">
            <el-input v-model="addItemForm.name"></el-input>
        </el-form-item>


        <el-form-item label="商品分类" prop="category" required>
            <chose-cate v-on:sendCategory="handleCategory"></chose-cate>
        </el-form-item>


        <el-form-item label="商品成本" prop="cost_price" required>
            <el-input placeholder="请输入成本" v-model.number="addItemForm.cost_price">
                <template slot="append">元</template>
            </el-input>
        </el-form-item>

        <el-form-item label="商品价格" prop="now_price" required>
            <el-input placeholder="请输入价格" v-model.number="addItemForm.now_price">
                <template slot="append">元</template>
            </el-input>
        </el-form-item>

        <el-form-item label="商品数量" prop="number" required>
            <el-input placeholder="请输入数量" v-model.number="addItemForm.number">
                <template slot="append">件</template>
            </el-input>
        </el-form-item>


        <el-form-item label="是否推荐" prop="recommend">
            <el-switch on-text="" off-text="" v-model="addItemForm.recommend"></el-switch>
        </el-form-item>

        <el-form-item label="商品标签" prop="tag">
            <el-checkbox-group v-model="addItemForm.tag">
                <el-checkbox label="热门商品" name="tag"></el-checkbox>
                <el-checkbox label="性价比超群" name="tag"></el-checkbox>
                <el-checkbox label="价格优惠" name="tag"></el-checkbox>
                <el-checkbox label="好评如潮" name="tag"></el-checkbox>
            </el-checkbox-group>
        </el-form-item>

        <el-form-item label="商品描述" prop="description">
            <quill-editor ref="myTextEditor"
                          v-model="addItemForm.description"
            >
            </quill-editor>
        </el-form-item>

        <el-form-item label="增加缩略图">
            <add-image v-on:sendPath="handleSendPath"></add-image>
        </el-form-item>

        <el-form-item>
            <el-button type="primary" @click="submitForm('addItemForm')">立即创建</el-button>
            <el-button @click="resetForm('addItemForm')">重置</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    import ChoseCate from './choseCategory.vue'
    import {quillEditor} from 'vue-quill-editor'
    import AddImage from './addImage.vue'

    export default {
        components: {
            ChoseCate,
            quillEditor,
            AddImage
        },

        data() {
            return {
                addItemForm: {
                    name: '',
                    category: '',
                    cost_price: 0,
                    now_price: 0,
                    number: 0,
                    recommend: false,
                    tag: [],
                    description: '<h1>this is example</h1>'
                },
                url: '',
                rules: {
                    name: [
                        {required: true, message: '请输入商品名称', trigger: 'blur'},
                        {min: 3, max: 15, message: '长度在 3 到 15 个字符', trigger: 'blur'}
                    ],
                    number: [
                        {type: 'number', message: '请输入数字', trigger: 'blur'}
                    ],
                    tag: [
                        {type: 'array', required: true, message: '请至少选择一个标签', trigger: 'change'}
                    ],
                    description: [
                        {required: true, message: '请填写商品描述', trigger: 'blur'}
                    ]
                }
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        axios.post('/api/item', {
                            data: this.addItemForm,
                            url: this.url
                        }).then(res => {
                            if (res.data.code == '200') {
                                this.$notify({
                                    title: '保存成功',
                                    message: '新增商品成功',
                                    type: 'success',
                                    duration: 2000,
                                    onClose(){
                                        location.reload()
                                    }
                                });
                            } else if (res.data.code !== '200') {
                                this.$notify({
                                    title: '保存失败',
                                    message: res.data.err_msg,
                                    type: 'error',

                                    duration: 2000,
                                    onClose(){
                                        location.reload()
                                    }
                                });
                            }
                        })
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            handleCategory(data){
                this.addItemForm.category = data
            },
            handleSendPath(data){
                this.url = data.url_path
            }
        }
    }
</script>
