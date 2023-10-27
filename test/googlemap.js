/**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
// Initialize and add the map
let map;

async function initMap() {
  // The location of the initial center
  const centerPosition = { lat: 13.7767903, lng: 121.0590017 };

  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  // Create the map, centered at the initial center
  map = new Map(document.getElementById("map"), {
    zoom: 12,
    center: centerPosition,
    mapId: "DEMO_MAP_ID",
  });

  // Array of marker positions
  const markerPositions = [
    { lat: 13.7767903, lng: 121.0590017, title: "alangilan" },
    { lat: 13.7654321, lng: 121.0789876, title: "balagtas" },
    { lat: 13.7890123, lng: 121.0456789, title: "Dolor" },
    // Add more marker positions as needed
  ];

  // Create markers for each position
  markerPositions.forEach((positionData) => {
    const marker = new AdvancedMarkerElement({
      map: map,
      position: positionData,
      title: positionData.title,
    });
  });
}

initMap();
