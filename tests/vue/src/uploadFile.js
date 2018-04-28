export default{
    getAuthorization(options,callback){
        var method = (options.Method || 'get').toLowerCase();
        var key = options.Key || '';
        var pathname = key.indexOf('/') === 0 ? key : '/' + key;
  
        var url = '../cos/auth.php';
        var xhr = new XMLHttpRequest();
        var data = {
            method: method,
            pathname: pathname,
          };
        xhr.open('POST', url, true);
        xhr.setRequestHeader('content-type', 'application/json');
        xhr.onload = function (e) {
            if (e.target.responseText === 'action deny') {
                alert('action deny');
            } else {
                callback(e.target.responseText);
            }
        };
        xhr.send(JSON.stringify(data));
      },
  
      // 上传文件
    uploadFile(file,callback){
            var Key = 'dir/' + file.name; // 这里指定上传目录和文件名
            getAuthorization({Method: 'PUT', Key: Key}, function (auth) {
    
                var url = prefix + Key;
                var xhr = new XMLHttpRequest();
                xhr.open('PUT', url, true);
                xhr.setRequestHeader('Authorization', auth);
                xhr.onload = function () {
                    if (xhr.status === 200 || xhr.status === 206) {
                        var ETag = xhr.getResponseHeader('etag');
                        callback(null, {url: url, ETag: ETag});
                    } else {
                        callback('文件 ' + Key + ' 上传失败，状态码：' + xhr.status);
                    }
                };
                xhr.onerror = function () {
                    callback('文件 ' + Key + ' 上传失败，请检查是否没配置 CORS 跨域规则');
                };
                xhr.send(file);
            });
        },

    upload(item){
        console.log('ok');
        uploadFile(item.file,function(err,data){
        console.log(err || data);
        console.log(data.Etag);
        });
    }

}
// 计算签名
