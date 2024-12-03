let config = null;

function throttle(callback, delay) {
  let timerId = null;
  let args;

  return function (props) {
    args = props;

    if (timerId) {
      return;
    }

    timerId = setTimeout(() => {
      callback(args);
      timerId = null;
    }, delay);
  };
}

function onSearchInput(event, config) {
  const query = event.target.value;
  config.pageNo = 1;
  config.loadedAllData = false;
  config.searchQuery = query.trim();

  // getFilteredData is defined in getFilteredData.js
  config.displayedCards = getFilteredData(
    config.searchQuery,
    config.pageNo,
    config.dataPerPage
  );

  config.pageNo++;

  // renderCards is defined in cardsHandler.js
  renderCards(config.displayedCards, config.cardContainerId);
}

function onContentLoad(config) {
  // getFilteredData is defined in getFilteredData.js
  config.displayedCards = getFilteredData(
    config.searchQuery,
    config.pageNo,
    config.dataPerPage
  );

  config.pageNo++;

  // renderCards is defined in cardsHandler.js
  renderCards(config.displayedCards, config.cardContainerId);
}

function onScroll(config) {
  if (config.loading || config.loadedAllData) {
    return;
  }

  const loadingNode = document.getElementById(config.loadingId);

  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    loadingNode.style.visibility = "visible";
    config.loading = true;

    setTimeout(() => {
      // loadMoreCards is defined in cardsHandler.js
      loadMoreCards(config);

      loadingNode.style.visibility = "hidden";
      config.loading = false;
    }, config.loadingDelay);
  }
}

function setEventListeners(config) {
  const searchBar = document.getElementById(config.searchBarId);

  document.addEventListener("DOMContentLoaded", () => onContentLoad(config));
  searchBar.addEventListener(
    "input",
    throttle((event) => onSearchInput(event, config), 200)
  );
  window.addEventListener(
    "scroll",
    throttle(() => onScroll(config), 200)
  );
}

function initilizeApp() {
  //config is central configuration object for the app
  config = {
    pageNo: 1,
    displayedCards: [],
    dataPerPage: 15,
    cardContainerId: "cards-container-div",
    searchBarId: "search-bar-div",
    searchQuery: "",
    loadedAllData: false,
    loadingId: "loading-div",
    loadingDelay: 1500,
    loadingStatus: false,
  };

  setEventListeners(config);
}

initilizeApp();
