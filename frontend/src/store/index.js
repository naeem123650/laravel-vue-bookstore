import { createStore } from "vuex";
import books from "./modules/books"

export default new createStore({
    modules: {
        books,
        
    }
});

