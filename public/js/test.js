// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// arr = {code: "10", name : "Cầu Giấy"};
// fetch('update-new-location', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify(arr)
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

// fetch('current-local-info')
// .then(response => response.json())
// .then(data => console.log(data));

// fetch('load-declared-permission')
// .then(response => response.json())
// .then(data => console.log(data));

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('add-new-user', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({username: '10',password: '10'})
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('submit-declared-permission', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({code: '10', startDate: '2021/12/01', endDate: '2021/12/31'})
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('delete-access', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({code: '10'})
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('edit-access', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({code: '10', startDate: '2021/12/03', endDate: '2021/12/31'})
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

fetch('account-location-info')
.then(response => response.json())
.then(data => console.log(data));