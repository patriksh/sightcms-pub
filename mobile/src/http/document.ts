import { httpGet } from './http';
import { DocumentsResponse, DocumentCategoriesResponse } from '@/types/document';

export const getDocuments = async (categorySlug?: string, page = 0): Promise<DocumentsResponse> => {
    return await httpGet(`documents?page=${page}&category=${categorySlug || ''}`);
}

export const getDocumentCategories = async(): Promise<DocumentCategoriesResponse> => {
    return await httpGet('documents/categories');
}