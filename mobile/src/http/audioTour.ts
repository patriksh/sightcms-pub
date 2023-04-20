import { httpGet } from './http';
import { AudioToursResponse, AudioTourResponse } from '@/types/audioTour';

export const getAudioTours = async (page = 0): Promise<AudioToursResponse> => {
    return await httpGet(`audio-tours?page=${page}`);
};

export const getAudioTour = async (slug: string): Promise<AudioTourResponse> => {
    return await httpGet(`audio-tours/${slug}`);
}