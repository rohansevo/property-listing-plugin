// document.addEventListener("DOMContentLoaded", function () {

//     const form = document.getElementById("plp-filter-form");
//     const resultsDiv = document.getElementById("plp-results");

//     if (!form) return;

//     form.addEventListener("submit", function (e) {
//         e.preventDefault();

//         const price = document.getElementById("price").value;
//         const bedrooms = document.getElementById("bedrooms").value;
//         const location = document.getElementById("location").value;

//         let url = "/wp-json/plp/v1/properties?";

//         if (price) url += `price=${price}&`;
//         if (bedrooms) url += `bedrooms=${bedrooms}&`;
//         if (location) url += `location=${encodeURIComponent(location)}&`;

//         fetch(url)
//             .then(res => res.json())
//             .then(data => {
//                 resultsDiv.innerHTML = "";

//                 if (data.length === 0) {
//                     resultsDiv.innerHTML = "<p>No properties found</p>";
//                     return;
//                 }

//                 data.forEach(item => {
//                     resultsDiv.innerHTML += `
//                         <div>
//                             <h3>${item.title}</h3>
//                             <p>Price: ${item.price}</p>
//                             <p>Bedrooms: ${item.bedrooms}</p>
//                             <p>Location: ${item.location}</p>
//                         </div>
//                     `;
//                 });
//             });
//     });

// });