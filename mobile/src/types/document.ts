import { Category } from './category';

export type DocumentCategory = Category;

export type Document = {
    _id: string,
    name: string,
    file_url: string|null,
    document_category_id: number|null,
    document_category: DocumentCategory|null
}

export type DocumentsResponse = {
    documents: {
        data: Document[],
        current_page: number,
        last_page: number,
        per_page: number,
        total: number
    }
}

export type DocumentCategoriesResponse = {
    categories: DocumentCategory[]
}