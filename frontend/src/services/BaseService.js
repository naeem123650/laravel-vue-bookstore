import axios from 'axios'

const apiClient = new axios.create({
    baseURL: "http://127.0.0.1:8000/api/v1/books",
    withCredentials: false,
    headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
    }
});

export default {
    getBooks(search) {
        if(search.search != undefined && search.search != ""){
            return apiClient.get(`/?search=${search}`);
        }

        return apiClient.get(`/?page=${search.pageIndex}`);
    },
    getBook(id) {
        return apiClient.get(`/${id}`);
    },
    storeBook(book) {
        const config = {
            headers: { 'content-type': 'multipart/form-data' }
        }

        return apiClient.post('/', book, config);
    },
    updateBook(book) {
        const config = {
            headers: { 'content-type': 'multipart/form-data' }
        }
        return apiClient.post(`/${book.id}`, book,config);
    },
    deleteBook(id) {
        return apiClient.delete(`/${id}`);
    },
}
