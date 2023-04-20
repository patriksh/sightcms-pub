import { httpGet } from './http';
import { ArticlesResponse, ArticleCategoriesResponse, ArticleResponse } from '@/types/article';

export const getArticles = async (categorySlug?: string, page = 0): Promise<ArticlesResponse> => {
    return await httpGet(`articles?page=${page}&category=${categorySlug || ''}`);
};

export const getArticleCategories = async(): Promise<ArticleCategoriesResponse> => {
    return await httpGet('articles/categories');
};

export const getArticle = async (slug: string): Promise<ArticleResponse> => {
    return await httpGet(`articles/${slug}`);
}