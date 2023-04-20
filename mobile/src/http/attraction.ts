import { httpGet } from './http';
import { AttractionsResponse, AttractionCategoriesResponse, AttractionResponse } from '@/types/attraction';

export const getAttractions = async (categorySlug?: string, page = 0): Promise<AttractionsResponse> => {
    return await httpGet(`attractions?page=${page}&category=${categorySlug || ''}`);
};

export const getAttractionCategories = async(): Promise<AttractionCategoriesResponse> => {
    return await httpGet('attractions/categories');
};

export const getAttraction = async (slug: string): Promise<AttractionResponse> => {
    return await httpGet(`attractions/${slug}`);
}