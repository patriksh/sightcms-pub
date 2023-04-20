import { httpGet } from './http';
import { EventsResponse, EventResponse } from '@/types/event';

export const getEvents = async (type?: string, page = 0): Promise<EventsResponse> => {
    return await httpGet(`events?page=${page}&type=${type || ''}`);
}

export const getEvent = async (slug: string): Promise<EventResponse> => {
    return await httpGet(`events/${slug}`);
}