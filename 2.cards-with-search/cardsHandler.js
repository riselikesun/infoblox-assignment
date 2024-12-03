function generateHtmlCard(card) {
  const cardElement = document.createElement("div");
  cardElement.className = "card";
  cardElement.innerHTML = `
            <img class='card-image' src="${card.Image}" alt="${card.Title}">
            <div class="card-content">
              <h3>${card.Title}</h3>
              <p><b>Author:</b> ${card.Author}</p>
              <p><b>Date:</b> ${card.Date}</p>
            </div>
          `;

  return cardElement;
}

function renderCards(cards, cardContainerId, flushData = true) {
  const cardContainerNode = document.getElementById(cardContainerId);

  if (flushData) {
    cardContainerNode.innerHTML = "";
  }

  cards.forEach((card) => {
    const cardElement = generateHtmlCard(card);

    cardContainerNode.appendChild(cardElement);
  });
}

function loadMoreCards(config) {
  // getFilteredData is defined in getFilteredData.js
  const filteredData = getFilteredData(
    config.searchQuery,
    config.pageNo,
    config.dataPerPage
  );

  if (filteredData.length < 1) {
    config.loadedAllData = true;
    return;
  }

  config.pageNo++;
  config.displayedCards = config.displayedCards.concat(filteredData);

  renderCards(filteredData, config.cardContainerId, false);
}
