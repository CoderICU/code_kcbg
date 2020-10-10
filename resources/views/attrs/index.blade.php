@extends('layouts.app')

@section('content')
<div class="container">

    <div class="text-right">
        <button class="btn btn-primary mt-3" type="button" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">添加</button>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">添加规格</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="attr-name" class="col-form-label">名称:</label>
                  <input type="text" class="form-control" id="attr-name" v-model="new_attr.name">
                </div>
                <div class="form-group">
                  <label for="attr-type" class="col-form-label">类型:</label>
                  <select class="form-control" id="attr-type" v-model="new_attr.type">
                    <option value="text">文本</option>
                    <option value="time">时间</option>
                    <option value="img">图片</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
              <button type="button" class="btn btn-primary" v-on:click="saveAttr">保存</button>
            </div>
          </div>
        </div>
    </div>

    <table class="table table-bordered" style="background-color: #fff; margin-top: 8px;">
        <thead>
          <tr>
            <th>名称</th>
            <th>类型</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($attrs as $attr)
            <tr>
                <td>{{ $attr->name }}</td>
                @switch($attr->type)
                    @case('text')
                        <td>文本</td>
                        @break
                    @case('img')
                        <td>图片</td>
                        @break
                    @case('time')
                        <td>时间</td>
                        @break
                    @default
                        <td>其它</td>
                @endswitch
                <td>
                    <form action="{{ route('attrs.destroy', $attr->id) }}" method="post" class="folat-right">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {!! $attrs->render() !!}
    </div>
</div>


@endsection

@section('body-tail')
<script>
    new Vue({
        el: '#app',
        data: {
            new_attr: {
                name: '',
                type: '',
            }
        },
        methods: {
            saveAttr: function () {
                if (this.new_attr.name == '') {
                    alert('请输入规格名称');
                } else if (this.new_attr.type == '') {
                    alert('请选择规格类型');
                } else {
                    $.ajax({
                        type: 'POST',
                        url: "attrs",
                        dataType: 'json',
                        data: {
                            'name': this.new_attr.name,
                            'type': this.new_attr.type,
                            '_token':'{{csrf_token()}}'
                        },
                        success: function (data) {
                            if (data.code == '200') {
                                layer.msg('保存成功');
                                $('#exampleModal').modal('hide')
                                document.location.reload();
                            } else {
                                alert(data.msg?data.msg:'保存失败');
                            }
                        },
                        error: function (msg) {
                            if (msg.status == 422) {
                                var json=JSON.parse(msg.responseText);
                                json = json.errors;
                                for ( var item in json) {
                                    for ( var i = 0; i < json[item].length; i++) {
                                        alert(json[item][i]);
                                        return ; //遇到验证错误，就退出
                                    }
                                }
                            } else {
                                alert('服务器连接失败');
                                return ;
                            }
                        }
                    });
                }
            }
        }
    })
</script>
@endsection
