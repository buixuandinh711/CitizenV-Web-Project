var csrfToken = $("meta[name='csrf-token']").attr("content");  
arr = [{code: "01", name : "Cầu Giấy"}, {code : "02", name : "Ba Đình"}, {code : "03", name : "Đống Đa"}];
fetch('update-new-location', {
    method: 'post',
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-Token": csrfToken
    },
    body: JSON.stringify(arr)
  }).then(function(response) {
    return response.json();
  }).then(function(data) {
    console.log(data);
  });

fetch('current-local-info')
.then(response => response.json())
.then(data => console.log(data));