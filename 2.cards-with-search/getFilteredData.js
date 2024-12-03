function getFilteredData(queryString, pageNo, dataPerPage) {
  if (pageNo <= 0) {
    return [];
  }

  const lowerCaseQuery = queryString.toLowerCase();

  // data is defined in data.js
  const filteredData = data
    .filter(
      (item) =>
        item.Title.toLowerCase().includes(lowerCaseQuery) ||
        item.Author.toLowerCase().includes(lowerCaseQuery)
    )
    .slice((pageNo - 1) * dataPerPage, pageNo * dataPerPage);

  return filteredData;
}
