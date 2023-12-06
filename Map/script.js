// Sample data (replace with your actual data)
const zoomLevel = 14; // Adjust the zoom level as needed

// Function to initialize the map
function initMap() {
    // Create a map centered on a default location
    const map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 13.7565, lng: 121.0583 },
        zoom: zoomLevel,
    });

    // Fetch addresses from the server using AJAX
    fetch('fetch_address.php')
        .then(response => response.json())
        .then(addresses => {
            // Use the retrieved addresses in your heatmap logic
            processAddresses(map, addresses);
        })
        .catch(error => {
            console.error('Error fetching addresses:', error);
        });
}

// Function to process addresses and create a heatmap and markers
function processAddresses(map, addresses) {
    const geocoder = new google.maps.Geocoder();
    const heatmapData = [];
    const markers = [];

    // Create an object to store the count of each address
    const addressCount = {};

    // Count occurrences of each address
    addresses.forEach(address => {
        addressCount[address] = (addressCount[address] || 0) + 1;
    });

    // Counter for processed addresses
    let processedAddresses = 0;

    // Loop through addresses and add to heatmap data and markers
    addresses.forEach(address => {
        geocoder.geocode({ address: address }, (results, status) => {
            if (status === 'OK' && results[0].geometry) {
                const location = results[0].geometry.location;

                // Increase the weight to intensify the heatmap
                const weight = (addressCount[address] || 1) * 4;

                // Add points to heatmap data with calculated weight
                for (let i = 0; i < weight; i++) {
                    heatmapData.push({
                        location: new google.maps.LatLng(location.lat(), location.lng()),
                        weight: weight,
                    });
                }

                // Add marker for each address
                const marker = new google.maps.Marker({
                    position: new google.maps.LatLng(location.lat(), location.lng()),
                    map: map,
                    title: address,
                });

                markers.push(marker);
            } else {
                console.error(`Geocoding failed for address: ${address}`);
            }

            // Increment the counter for processed addresses
            processedAddresses++;

            // Create and set the heatmap layer once all geocoding is done
            if (processedAddresses === addresses.length) {
                const heatmap = new google.maps.visualization.HeatmapLayer({
                    data: heatmapData,
                    map: map,
                    radius: 150, // Adjust the default radius as needed
                });
            }
        });
    });
}
