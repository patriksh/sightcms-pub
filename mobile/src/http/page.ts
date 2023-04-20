import { httpGet } from './http';
import { PagesResponse, PageResponse } from '@/types/page';

export const getPages = async (): Promise<PagesResponse> => {
    return await httpGet(`pages`);
}

export const getPage = async (slug: string): Promise<PageResponse> => {
    return await httpGet(`pages/${slug}`);
}