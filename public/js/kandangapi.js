// // Get the token from the session storage
// const token = sessionStorage.getItem('auth_token'); // Use sessionStorage or localStorage
// const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


// fetch('http://127.0.0.1:8000/api/products', {
//     method: 'GET',
//     headers: {
//         'Authorization': `Bearer ${token}`,
//         'X-CSRF-TOKEN': csrfToken,
//         'Content-Type': 'application/json',
//     },
//     credentials: 'include',  // Include cookies with the request
// })
// .then(response => {
//     if (response.ok) {
//         return response.json();
//     }
//     throw new Error('Unauthorized');
// })
// .then(data => {
//     console.log(data);
// })
// .catch(error => {
//     console.error(error);
//     window.location.href = '/login';  // Redirect to login if unauthorized
// });
