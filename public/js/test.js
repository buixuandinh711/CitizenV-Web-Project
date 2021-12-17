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

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// arr = {code: "10"};
// fetch('delete-location', {
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

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// arr = {code: "10", name : "Đống Đa"};
// fetch('edit-location', {
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
// fetch('edit-user', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({username: '10', password: '20'})
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('delete-user', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({username: '10'})
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

// fetch('account-location-info')
// .then(response => response.json())
// .then(data => console.log(data));

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('add-person', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({
//       code	: '123456789',
//       name	: 'Nguyen Van A',
//       date	: '2000/01/01',
//       gender	: 'Nam',
//       home_town : 'Văn Than - Cao Đức - Gia Bình - Bắc Ninh',
//       permanent_address : 'Văn Than - Cao Đức - Gia Bình - Bắc Ninh',	
//       temporary_address	: 'Văn Than - Cao Đức - Gia Bình - Bắc Ninh',
//       religion	: 'Không',
//       level	: 'THPT',
//       job : 'Làm ruộng'})
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

//   var csrfToken = $("meta[name='csrf-token']").attr("content");  
//   fetch('edit-person', {
//       method: 'post',
//       headers: {
//           "Content-Type": "application/json",
//           "X-CSRF-Token": csrfToken
//       },
//       body: JSON.stringify({
//         code	: '123456789',
//         name	: 'Nguyen Van B',
//         date	: '2000/01/01',
//         gender	: 'Nam',
//         home_town : 'Văn Than - Cao Đức - Gia Bình - Bắc Ninh',
//         permanent_address : 'Văn Than - Cao Đức - Gia Bình - Bắc Ninh',	
//         temporary_address	: 'Văn Than - Cao Đức - Gia Bình - Bắc Ninh',
//         religion	: 'Không',
//         level	: 'THPT',
//         job : 'Làm ruộng'})
//     }).then(function(response) {
//       return response.json();
//     }).then(function(data) {
//       console.log(data);
//     });

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('delete-person', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({
//       code	: '123456789'
//       })
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

// fetch('follow-declare-population')
// .then(response => response.json())
// .then(data => console.log(data));

fetch('declare-permission-location-info')
.then(response => response.json())
.then(data => console.log(data));