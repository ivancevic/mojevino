const BASE_URL =
  "https://cors-anywhere.herokuapp.com/https://api.mouser.com/api/v1/search/keyword=batteries?apiKey=20514a5b-04e7-409b-9a5c-dfd0a6e963a5";


const getTodos = async () => {
  try {
    const res = await axios.post(`${BASE_URL}`);

    const todos = res.data;

    console.log(`GET: Here's the list of todos`, todos);

    return todos;
  } catch (e) {
    console.error(e);
  }
};

getTodos();
