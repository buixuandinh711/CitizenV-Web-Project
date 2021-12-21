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
// fetch('delete-account', {
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
//     body: JSON.stringify({code: '64', startDate: '2021/12/01', endDate: '2021/12/31'})
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('delete-permission', {
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
// fetch('submit-new-citizen', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({
//       id : '123456789123', 
//       name: 'Nguyễn Văn A',  
//       gender: 'Nam', 
//       dateOfBirth: '2000/1/1', 
//       permanentAddress: '01010101', 
//       currentAddress: '01010101', 
//       religion: 'Không', 
//       grade: 'ThPT',
//       job: 'Làm ruộng'})
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

  // var csrfToken = $("meta[name='csrf-token']").attr("content");  
  // fetch('edit-person', {
  //     method: 'post',
  //     headers: {
  //         "Content-Type": "application/json",
  //         "X-CSRF-Token": csrfToken
  //     },
  //     body: JSON.stringify({
  //       id : '123456789123', 
  //     name: 'Nguyễn Văn B',  
  //     gender: 'Nam', 
  //     dateOfBirth: '2000/1/1', 
  //     permanentAddress: '01010101', 
  //     currentAddress: '01010101', 
  //     religion: 'Không', 
  //     grade: 'ThPT',
  //       job : 'Làm ruộng'})
  //   }).then(function(response) {
  //     return response.json();
  //   }).then(function(data) {
  //     console.log(data);
  //   });

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

// fetch('declare-permission-location-info')
// .then(response => response.json())
// .then(data => console.log(data));

// fetch('show-list-population')
// .then(response => response.json())
// .then(data => console.log(data));

// fetch('show-total-population')
// .then(response => response.json())
// .then(data => console.log(data));

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('show-info-population', {
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

// fetch('show-total-population-each-city')
// .then(response => response.json())
// .then(data => console.log(data));

// fetch('show-total-population-each-district')
// .then(response => response.json())
// .then(data => console.log(data));

// fetch('show-total-population-each-ward')
// .then(response => response.json())
// .then(data => console.log(data));

// fetch('show-total-population-each-village')
// .then(response => response.json())
// .then(data => console.log(data));

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('show-list-population-each-city', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({
//       code	: '01'
//       })
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('show-list-population-each-district', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({
//       code	: '0101'
//       })
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('show-list-population-each-ward', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({
//       code	: '010101'
//       })
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('show-list-population-each-village', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({
//       code	: '01010101'
//       })
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

// fetch('get-city')
// .then(response => response.json())
// .then(data => console.log(data));

var csrfToken = $("meta[name='csrf-token']").attr("content");  
fetch('get-district', {
    method: 'post',
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-Token": csrfToken
    },
    body: JSON.stringify({
      code	: '01'
      })
  }).then(function(response) {
    return response.json();
  }).then(function(data) {
    console.log(data);
  });

//   var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('get-ward', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({
//       code	: '0101'
//       })
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });

// var csrfToken = $("meta[name='csrf-token']").attr("content");  
// fetch('get-village', {
//     method: 'post',
//     headers: {
//         "Content-Type": "application/json",
//         "X-CSRF-Token": csrfToken
//     },
//     body: JSON.stringify({
//       code	: '010101'
//       })
//   }).then(function(response) {
//     return response.json();
//   }).then(function(data) {
//     console.log(data);
//   });