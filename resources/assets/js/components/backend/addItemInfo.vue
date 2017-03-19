<template>

    <div>
        <h1>添加一个商品:</h1>
        <hr>
        <div class="addName">
            <h3>
                添加商品名称:
            </h3>
            <el-input v-model="name" placeholder="请输入商品名称"></el-input>
        </div>
        <div class="addDescription">
            <h3>
                添加商品描述:
            </h3>
            <quill-editor ref="myTextEditor"
                          v-model="content"
                          :config="editorOption"
                          @blur="onEditorBlur($event)"
                          @focus="onEditorFocus($event)"
                          @ready="onEditorReady($event)">
            </quill-editor>
        </div>
        <hr>

        <div class="tagAdd" style="margin-top:20px;">
            <h5>选择商品分类：</h5>
            <chose-cate></chose-cate>
            <hr>
            <h5>增加新标签:</h5>
            <add-tag></add-tag>
        </div>
        <hr>
        <div class="addPriceNum">
            <el-row :gutter="20">
                <el-col :span="8">
                    <h5>输入价格：</h5>
                    <el-input placeholder="请输入内容" v-model="now_price">
                        <template slot="append">元</template>
                    </el-input>
                </el-col>

                <el-col :span="8">
                    <h5>输入成本：</h5>
                    <el-input placeholder="请输入内容" v-model="cost_price">
                        <template slot="append">元</template>
                    </el-input>
                </el-col>
                <el-col :span="8">
                    <h5>输入数量：</h5>
                    <el-input placeholder="请输入内容" v-model="number">
                        <template slot="append">件</template>
                    </el-input>
                </el-col>
            </el-row>

        </div>
        <hr>
        <div class="addImg">
            <el-row>
                <el-col :span="12">
                    <add-image></add-image>
                </el-col>
            </el-row>
        </div>
        <hr>
        <div class="submitBtn" style="margin-top:20px">
            <el-button type="primary">保存</el-button>
        </div>

    </div>

</template>

<script>
    import {quillEditor} from 'vue-quill-editor'
    import AddTag from './addTag.vue'
    import ChoseCate from './choseCategory.vue'
    import AddImage from './addImage.vue'
    export default {
        data () {
            return {
                name: '',
                cost_price: '',
                now_price: '',
                number: '',
                content: '<h2>I am Example</h2>',
                editorOption: {
                    // something config
                }
            }
        },
        components: {
            quillEditor,
            AddTag,
            ChoseCate,
            AddImage
        },
        // if you need to manually control the data synchronization, parent component needs to explicitly emit an event instead of relying on implicit binding
        // 如果需要手动控制数据同步，父组件需要显式地处理changed事件
        methods: {
            onEditorBlur(editor) {
                console.log('editor blur!', editor)
            },
            onEditorFocus(editor) {
                console.log('editor focus!', editor)
            },
            onEditorReady(editor) {
                console.log('editor ready!', editor)
            },
            onEditorChange({editor, html, text}) {
                // console.log('editor change!', editor, html, text)
                this.content = html
            }
        },
        // if you need to get the current editor object, you can find the editor object like this, the $ref object is a ref attribute corresponding to the dom redefined
        // 如果你需要得到当前的editor对象来做一些事情，你可以像下面这样定义一个方法属性来获取当前的editor对象，实际上这里的$refs对应的是当前组件内所有关联了ref属性的组件元素对象
        computed: {
            editor() {
                return this.$refs.myTextEditor.quillEditor
            }
        },
        mounted() {
            // you can use current editor object to do something(editor methods)
            console.log('this is my editor', this.editor)
            // this.editor to do something...
        }
    }
</script>