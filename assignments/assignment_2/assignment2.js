/**
 * This function sets up the click listeners that allow
 * the user to change the featured image.
 */
function setupThumbnailListeners() {
  // We get the thumbnail elements
  const thumbnailElement = document.getElementById("thumbnails");
  // We iterate through all the children of the thumbnail
  for (i = 0; i < thumbnailElement.childElementCount; i++) {
    thumbnailElement.children[i].addEventListener("click", (event) => {
      event.preventDefault();
      // We get the image source and title from the event
      const imageSrc = event.target.attributes.src.nodeValue;
      const title = event.target.attributes.title.nodeValue;
      const imageComponents = imageSrc.split("/");
      // We reconstruct the image src to get the larger version
      const mediumImageSrc = [imageComponents[0], "medium", imageComponents[2]].join("/");
      // We get the featured element. Since we know that the image comes before the caption,
      // we make the appropriate modifications to the children.
      const featured = document.getElementById("featured");
      featured.children[0].src = mediumImageSrc;
      featured.children[0].title = title;
      featured.children[1].innerText = mediumImageSrc;
    });
  }
}

/**
 * This funciton sets up the listeners that allow the user
 * to see the caption when hovering over the featured image.
 */
function setupFeaturedCaptionListeners() {
  const featured = document.getElementById("featured");
  featured.addEventListener("mouseover", (event) => {
    event.preventDefault();
    const newHeader = document.createElement("h2");
    const newText = document.createTextNode(featured.children[0].attributes.title.nodeValue);
    newHeader.appendChild(newText);
    newHeader.style['zIndex'] = 2;
    document.getElementById("figure_container").appendChild(newHeader);
  });
  featured.addEventListener("mouseout", (event) => {
    event.preventDefault();
    figureContainer = document.getElementById("figure_container");
    childToRemove = figureContainer.children[figureContainer.childElementCount - 1];
    figureContainer.removeChild(childToRemove);
  });
}

// We wait for the window to load to add our listeners. 
window.addEventListener("load", () => {
  setupThumbnailListeners();
  setupFeaturedCaptionListeners();
});