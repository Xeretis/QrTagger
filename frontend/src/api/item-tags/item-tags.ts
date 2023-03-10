/**
 * Generated by orval v6.11.0 🍺
 * Do not edit manually.
 * QrTagger
 * OpenAPI spec version: v1
 */
import {
  useQuery,
  useMutation
} from '@tanstack/react-query'
import type {
  UseQueryOptions,
  UseMutationOptions,
  QueryFunction,
  MutationFunction,
  UseQueryResult,
  QueryKey
} from '@tanstack/react-query'
import type {
  IndexItemTagsResponse,
  CreateItemTagResponse,
  ProblemDetails,
  CreateItemTagRequest,
  ViewItemTagResponse,
  UpdateItemTagRequest
} from '.././model'
import { useCustomClient } from '.././customClient';
import type { ErrorType, BodyType } from '.././customClient';


export const useGetApiItemTagsHook = () => {
        const getApiItemTags = useCustomClient<IndexItemTagsResponse[]>();

        return (
    
 signal?: AbortSignal
) => {
        return getApiItemTags(
          {url: `/Api/ItemTags`, method: 'get', signal
    },
          );
        }
      }
    

export const getGetApiItemTagsQueryKey = () => [`/Api/ItemTags`];

    
export type GetApiItemTagsQueryResult = NonNullable<Awaited<ReturnType<ReturnType<typeof useGetApiItemTagsHook>>>>
export type GetApiItemTagsQueryError = ErrorType<unknown>

export const useGetApiItemTags = <TData = Awaited<ReturnType<ReturnType<typeof useGetApiItemTagsHook>>>, TError = ErrorType<unknown>>(
  options?: { query?:UseQueryOptions<Awaited<ReturnType<ReturnType<typeof useGetApiItemTagsHook>>>, TError, TData>, }

  ):  UseQueryResult<TData, TError> & { queryKey: QueryKey } => {

  const {query: queryOptions} = options ?? {};

  const queryKey =  queryOptions?.queryKey ?? getGetApiItemTagsQueryKey();

  const getApiItemTags =  useGetApiItemTagsHook();


  const queryFn: QueryFunction<Awaited<ReturnType<ReturnType<typeof useGetApiItemTagsHook>>>> = ({ signal }) => getApiItemTags(signal);


  

  const query = useQuery<Awaited<ReturnType<ReturnType<typeof useGetApiItemTagsHook>>>, TError, TData>(queryKey, queryFn, queryOptions) as  UseQueryResult<TData, TError> & { queryKey: QueryKey };

  query.queryKey = queryKey;

  return query;
}

export const usePostApiItemTagsHook = () => {
        const postApiItemTags = useCustomClient<CreateItemTagResponse>();

        return (
    createItemTagRequest: BodyType<CreateItemTagRequest>,
 ) => {
        return postApiItemTags(
          {url: `/Api/ItemTags`, method: 'post',
      headers: {'Content-Type': 'application/json', },
      data: createItemTagRequest
    },
          );
        }
      }
    


    export type PostApiItemTagsMutationResult = NonNullable<Awaited<ReturnType<ReturnType<typeof usePostApiItemTagsHook>>>>
    export type PostApiItemTagsMutationBody = BodyType<CreateItemTagRequest>
    export type PostApiItemTagsMutationError = ErrorType<ProblemDetails>

    export const usePostApiItemTags = <TError = ErrorType<ProblemDetails>,
    
    TContext = unknown>(options?: { mutation?:UseMutationOptions<Awaited<ReturnType<ReturnType<typeof usePostApiItemTagsHook>>>, TError,{data: BodyType<CreateItemTagRequest>}, TContext>, }
) => {
      const {mutation: mutationOptions} = options ?? {};

      const postApiItemTags =  usePostApiItemTagsHook()


      const mutationFn: MutationFunction<Awaited<ReturnType<ReturnType<typeof usePostApiItemTagsHook>>>, {data: BodyType<CreateItemTagRequest>}> = (props) => {
          const {data} = props ?? {};

          return  postApiItemTags(data,)
        }

        

      return useMutation<Awaited<ReturnType<typeof postApiItemTags>>, TError, {data: BodyType<CreateItemTagRequest>}, TContext>(mutationFn, mutationOptions);
    }
    export const useGetApiItemTagsTokenHook = () => {
        const getApiItemTagsToken = useCustomClient<ViewItemTagResponse>();

        return (
    token: string,
 signal?: AbortSignal
) => {
        return getApiItemTagsToken(
          {url: `/Api/ItemTags/${token}`, method: 'get', signal
    },
          );
        }
      }
    

export const getGetApiItemTagsTokenQueryKey = (token: string,) => [`/Api/ItemTags/${token}`];

    
export type GetApiItemTagsTokenQueryResult = NonNullable<Awaited<ReturnType<ReturnType<typeof useGetApiItemTagsTokenHook>>>>
export type GetApiItemTagsTokenQueryError = ErrorType<ProblemDetails>

export const useGetApiItemTagsToken = <TData = Awaited<ReturnType<ReturnType<typeof useGetApiItemTagsTokenHook>>>, TError = ErrorType<ProblemDetails>>(
 token: string, options?: { query?:UseQueryOptions<Awaited<ReturnType<ReturnType<typeof useGetApiItemTagsTokenHook>>>, TError, TData>, }

  ):  UseQueryResult<TData, TError> & { queryKey: QueryKey } => {

  const {query: queryOptions} = options ?? {};

  const queryKey =  queryOptions?.queryKey ?? getGetApiItemTagsTokenQueryKey(token);

  const getApiItemTagsToken =  useGetApiItemTagsTokenHook();


  const queryFn: QueryFunction<Awaited<ReturnType<ReturnType<typeof useGetApiItemTagsTokenHook>>>> = ({ signal }) => getApiItemTagsToken(token, signal);


  

  const query = useQuery<Awaited<ReturnType<ReturnType<typeof useGetApiItemTagsTokenHook>>>, TError, TData>(queryKey, queryFn, {enabled: !!(token), ...queryOptions}) as  UseQueryResult<TData, TError> & { queryKey: QueryKey };

  query.queryKey = queryKey;

  return query;
}

export const usePutApiItemTagsIdHook = () => {
        const putApiItemTagsId = useCustomClient<void>();

        return (
    id: number,
    updateItemTagRequest: BodyType<UpdateItemTagRequest>,
 ) => {
        return putApiItemTagsId(
          {url: `/Api/ItemTags/${id}`, method: 'put',
      headers: {'Content-Type': 'application/json', },
      data: updateItemTagRequest
    },
          );
        }
      }
    


    export type PutApiItemTagsIdMutationResult = NonNullable<Awaited<ReturnType<ReturnType<typeof usePutApiItemTagsIdHook>>>>
    export type PutApiItemTagsIdMutationBody = BodyType<UpdateItemTagRequest>
    export type PutApiItemTagsIdMutationError = ErrorType<ProblemDetails>

    export const usePutApiItemTagsId = <TError = ErrorType<ProblemDetails>,
    
    TContext = unknown>(options?: { mutation?:UseMutationOptions<Awaited<ReturnType<ReturnType<typeof usePutApiItemTagsIdHook>>>, TError,{id: number;data: BodyType<UpdateItemTagRequest>}, TContext>, }
) => {
      const {mutation: mutationOptions} = options ?? {};

      const putApiItemTagsId =  usePutApiItemTagsIdHook()


      const mutationFn: MutationFunction<Awaited<ReturnType<ReturnType<typeof usePutApiItemTagsIdHook>>>, {id: number;data: BodyType<UpdateItemTagRequest>}> = (props) => {
          const {id,data} = props ?? {};

          return  putApiItemTagsId(id,data,)
        }

        

      return useMutation<Awaited<ReturnType<typeof putApiItemTagsId>>, TError, {id: number;data: BodyType<UpdateItemTagRequest>}, TContext>(mutationFn, mutationOptions);
    }
    export const useDeleteApiItemTagsIdHook = () => {
        const deleteApiItemTagsId = useCustomClient<void>();

        return (
    id: number,
 ) => {
        return deleteApiItemTagsId(
          {url: `/Api/ItemTags/${id}`, method: 'delete'
    },
          );
        }
      }
    


    export type DeleteApiItemTagsIdMutationResult = NonNullable<Awaited<ReturnType<ReturnType<typeof useDeleteApiItemTagsIdHook>>>>
    
    export type DeleteApiItemTagsIdMutationError = ErrorType<ProblemDetails>

    export const useDeleteApiItemTagsId = <TError = ErrorType<ProblemDetails>,
    
    TContext = unknown>(options?: { mutation?:UseMutationOptions<Awaited<ReturnType<ReturnType<typeof useDeleteApiItemTagsIdHook>>>, TError,{id: number}, TContext>, }
) => {
      const {mutation: mutationOptions} = options ?? {};

      const deleteApiItemTagsId =  useDeleteApiItemTagsIdHook()


      const mutationFn: MutationFunction<Awaited<ReturnType<ReturnType<typeof useDeleteApiItemTagsIdHook>>>, {id: number}> = (props) => {
          const {id} = props ?? {};

          return  deleteApiItemTagsId(id,)
        }

        

      return useMutation<Awaited<ReturnType<typeof deleteApiItemTagsId>>, TError, {id: number}, TContext>(mutationFn, mutationOptions);
    }
    