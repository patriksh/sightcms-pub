import { httpGet } from './http';
import { GastrosResponse, GastroCategoriesResponse, GastroResponse } from '@/types/gastro';

export const getGastros = async (categorySlug?: string, page = 0): Promise<GastrosResponse> => {
    return await httpGet(`gastros?page=${page}&category=${categorySlug || ''}`);
};

export const getGastroCategories = async(): Promise<GastroCategoriesResponse> => {
    return await httpGet('gastros/categories');
};

export const getGastro = async (slug: string): Promise<GastroResponse> => {
    return await httpGet(`gastros/${slug}`);
}