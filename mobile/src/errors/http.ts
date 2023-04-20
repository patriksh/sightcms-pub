import { CustomError } from 'ts-custom-error'

export class HttpError extends CustomError {
    public constructor(public code: number, message?: string) {
        super(message)
    }
}

export class OfflineError extends CustomError {
    public constructor() {
        super('Offline')
    }
}