import { useEffect, useState } from "react";
import { router } from "@inertiajs/react";
import StarRating from "react-awesome-stars-rating";

const AddModal = (props: any) => {
    console.log("addModal", props);
    const onFinish = () => props.setLoading(false);

    const closeModal = () => {
        props.setShowModal(false);

        if (props.editFlag) {
            props.setToEditMovieValue({
                ...props.toEditMovieValue,
                id: "",
                title: "",
                memo: "",
                poster_path: "",
            });
        } else {
            props.setAdditionalMovieValue({
                ...props.additionalMovieValue,
                title: "",
                memo: "",
                poster_path: "",
            });
        }
        props.setEditFlag(false);
    };

    const [postData, setPostData] = useState({
        title: "",
        memo: "",
        poster_path: "",
        userId: props.auth.user.id,
        is_done: 0,
        editFlag: 0,
        date: "",
        star: 0,
    });

    const [putData, setPutData] = useState({
        id: 0,
        title: "",
        memo: "",
        poster_path: "",
        userId: props.auth.user.id,
        is_done: 0,
        editFlag: 1,
    });

    useEffect(() => {
        if (props.editFlag) {
            setPutData({
                ...putData,
                id: props.toEditMovieValue.id,
                title: props.toEditMovieValue.title,
                memo: props.toEditMovieValue.memo,
                poster_path: props.toEditMovieValue.poster_path,
            });
        } else {
            setPostData({
                ...postData,
                title: props.additionalMovieValue.title,
                memo: props.additionalMovieValue.memo,
                poster_path: props.additionalMovieValue.poster_path,
                date: props.additionalMovieValue.date,
                star: props.additionalMovieValue.star,
                is_done: props.doneFlag,
            });
        }
    }, [props]);

    const onSubmit = () => {
        props.setLoading(true);

        if (props.editFlag) {
            const url = route("want.movie.update.put", {
                id: props.toEditMovieValue.id,
            });
            router.post(url, putData, { onFinish });

            props.setAdditionalMovieValue({
                ...props.toEditMovieValue,
                id: 0,
                title: "",
                poster_path: "",
                memo: "",
            });

            setPutData({
                ...postData,
                id: 0,
                title: "",
                poster_path: "",
                memo: "",
            });
        } else {
            const url = route("want.movie.create");
            router.post(url, postData, { onFinish });

            props.setAdditionalMovieValue({
                ...props.additionalMovieValue,
                title: "",
                poster_path: "",
                memo: "",
            });
        }
        if (props.doneFlag == true) {
            props.getDone;
        } else {
            props.getWant;
        }
        closeModal();
    };

    const searchImages = () => {
        props.setLoading(true);
        const url = route("want.movie.search");
        if (props.editFlag) {
            router.get(url, putData, { onFinish });
        } else {
            router.get(url, postData, { onFinish });
        }
    };

    const onDelete = () => {
        props.setLoading(true);
        const url = route("want.movie.delete", {
            id: props.toEditMovieValue.id,
        });
        router.post(url, postData, { onFinish });
        closeModal();
    };

    const changeToDone = () => {
        props.setDoneFlag(true);
    };

    const changeToWant = () => {
        props.setDoneFlag(false);
    };

    const onChange = (value: number) => {
        setValue(value);
    };

    const [value, setValue] = useState(3);

    useEffect(() => {
        props.setAdditionalMovieValue({
            ...props.additionalMovieValue,
            star: value,
        });
    }, [value]);
    return (
        <>
            {props.showFlag || props.passedShowFlag ? (
                <div className="fixed top-0 left-0 right-0 w-hull h-full bg-black bg-opacity-70 flex justify-center items-center flex-col">
                    <div className="fixed top-0 right-0 m-4">
                        <button
                            onClick={closeModal}
                            type="button"
                            className="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="defaultModal"
                        >
                            <svg
                                aria-hidden="true"
                                className="w-8 h-8"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fillRule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clipRule="evenodd"
                                ></path>
                            </svg>
                            <span className="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div className="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <div className="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <button
                                onClick={changeToWant}
                                className="text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                Want to
                            </button>
                            <button
                                onClick={changeToDone}
                                className="text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                Done
                            </button>
                        </div>

                        <div className="space-y-6">
                            <div className="flex">
                                <input
                                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="タイトル"
                                    required
                                    value={
                                        props.editFlag
                                            ? props.toEditMovieValue.title
                                            : props.additionalMovieValue.title
                                    }
                                    onChange={(e) => {
                                        props.editFlag
                                            ? props.setToEditMovieValue({
                                                  ...props.toEditMovieValue,
                                                  title: e.target.value,
                                              })
                                            : props.setAdditionalMovieValue({
                                                  ...props.additionalMovieValue,
                                                  title: e.target.value,
                                              });
                                    }}
                                />
                                <button type="button" onClick={searchImages}>
                                    <i className="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                            <div>
                                <img
                                    src={
                                        props.editFlag
                                            ? props.toEditMovieValue.poster_path
                                            : props.additionalMovieValue
                                                  .poster_path
                                    }
                                    alt=""
                                />
                            </div>
                            <div>
                                <textarea
                                    placeholder="メモ"
                                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    value={
                                        props.editFlag
                                            ? props.toEditMovieValue.memo
                                            : props.additionalMovieValue.memo
                                    }
                                    onChange={(e) =>
                                        props.editFlag
                                            ? props.setToEditMovieValue({
                                                  ...props.toEditMovieValue,
                                                  memo: e.target.value,
                                              })
                                            : props.setAdditionalMovieValue({
                                                  ...props.additionalMovieValue,
                                                  memo: e.target.value,
                                              })
                                    }
                                />
                            </div>

                            {props.doneFlag && (
                                <div>
                                    {/* <label for="date" class="leading-7 text-sm text-gray-600">Date</label> */}
                                    <input
                                        type="date"
                                        name="date"
                                        className="mt-3 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out mr-1"
                                        onChange={(e) => {
                                            props.setAdditionalMovieValue({
                                                ...props.additionalMovieValue,
                                                date: e.target.value,
                                            });
                                        }}
                                    />
                                </div>
                            )}

                            {props.doneFlag && (
                                <div className="[&>*]:flex">
                                    <StarRating
                                        onChange={onChange}
                                        value={value}
                                    />
                                </div>
                            )}

                            <button
                                onClick={onSubmit}
                                type="submit"
                                className="w-full text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800"
                            >
                                {props.editFlag ? "更新" : "登録"}
                            </button>
                            {props.editFlag && (
                                <button
                                    onClick={onDelete}
                                    type="submit"
                                    className="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                >
                                    削除
                                </button>
                            )}
                        </div>
                    </div>
                </div>
            ) : (
                <></>
            )}
        </>
    );
};

export default AddModal;
